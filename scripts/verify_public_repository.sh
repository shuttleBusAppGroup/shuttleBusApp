#!/usr/bin/env bash

set -euo pipefail

repo_root="$(cd -- "$(dirname -- "${BASH_SOURCE[0]}")/.." && pwd)"
cd "$repo_root"

fail() {
    printf 'FAIL: %s\n' "$1" >&2
    exit 1
}

command -v php >/dev/null || fail "php is required"
command -v rg >/dev/null || fail "rg is required"
command -v gitleaks >/dev/null || fail "gitleaks is required"

git check-ignore -q .env || fail ".env is not ignored"
if git check-ignore -q .env.example; then
    fail ".env.example is ignored"
fi

if git ls-files --error-unmatch .env >/dev/null 2>&1; then
    fail ".env is tracked"
fi

for variable_name in DB_HOST DB_NAME DB_USER DB_PASSWORD; do
    rg -q "^${variable_name}=replace_with_" .env.example || fail "${variable_name} is not a placeholder"
done
rg -q '^DB_PORT=3306$' .env.example || fail "DB_PORT does not use the documented default"

if git ls-files | rg -q '(^|/)(create_admin\.php|test\.sql)$|\.pdf$'; then
    fail "an obsolete or sensitive artifact is tracked"
fi

if rg -q --glob '*.php' "display_(startup_)?errors['\"],[[:space:]]*1|connect_error|mysqli_error\(" .; then
    fail "a PHP page exposes debug or database errors"
fi

git ls-files -z '*.php' | while IFS= read -r -d '' php_file; do
    php -l "$php_file" >/dev/null
done

php -r '
$sql = file_get_contents($argv[1]);
$tableCount = preg_match_all("/^CREATE TABLE /m", $sql);
$foreignKeyCount = substr_count($sql, "ADD CONSTRAINT");
preg_match_all("/[A-Z0-9._%+-]+@([A-Z0-9.-]+\.[A-Z]{2,})/i", $sql, $emailMatches);
$invalidDomains = array_filter(
    $emailMatches[1],
    fn($domain) => strtolower($domain) !== "example.invalid"
);

if (!preg_match("/INSERT INTO \\`users\\`.*?VALUES\s*(.*?);/s", $sql, $userInsert)) {
    fwrite(STDERR, "FAIL: the user fixtures are missing\n");
    exit(1);
}

$rows = preg_split("/\),\s*\(/", trim($userInsert[1], "()\r\n "));
$invalidHashes = 0;
foreach ($rows as $row) {
    $fields = str_getcsv($row, ",", "\x27", "");
    if (count($fields) !== 7 || password_get_info(trim($fields[3]))["algo"] === null) {
        $invalidHashes++;
    }
}

if ($tableCount !== 11 || $foreignKeyCount !== 11 || count($invalidDomains) !== 0 || $invalidHashes !== 0) {
    fwrite(STDERR, "FAIL: the SQL schema or fixtures failed validation\n");
    exit(1);
}

printf(
    "SQL checks passed: %d tables, %d foreign keys, %d hashed user fixtures.\n",
    $tableCount,
    $foreignKeyCount,
    count($rows)
);
' bus_app.sql

gitleaks detect --source . --no-git --config .gitleaks.toml --redact --no-banner

if [[ "${1:-}" == "--require-clean" ]] && [[ -n "$(git status --porcelain)" ]]; then
    fail "the worktree is not clean"
fi

printf 'Public repository checks passed.\n'
