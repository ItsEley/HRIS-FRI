#!/bin/bash

mysql -u root  famco-hrms < /testing-env/cron_jobs/reset_leave_balance.sql
