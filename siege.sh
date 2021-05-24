#!/bin/bash

NONE="\033[00m"
GREEN="\033[01;32m"
BOLD="\033[1m"
URL="siege-urls.txt"
REPEAT=10

echo "[" > result.json
concurrencies=(10 25 50 100)

for con in "${concurrencies[@]}"
do
    echo "\n${GREEN}${BOLD}Concurency ${con}${NONE}"

    result=$(siege -c${con} -r${REPEAT} -f ${URL})
    printf '%s\n' "${result[@]}"

    printf '%s,' "${result[@]}" >> result.json
done
echo "]" >> result.json
