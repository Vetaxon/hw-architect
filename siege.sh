#!/bin/bash

result=$(siege -c100 -b -r1 "http://app.test/users?date_of_birth_start=1983-06-22&date_of_birth_end=1983-06-22")
printf '%s\n' "${result[@]}"
printf '%s' "${result[@]}" >> result-users.json


result=$(siege -c100 -r1 "http://app.test/index-users?date_of_birth_start=1983-06-22&date_of_birth_end=1983-06-22")
printf '%s\n' "${result[@]}"
printf '%s' "${result[@]}" >> result-index-users.json
