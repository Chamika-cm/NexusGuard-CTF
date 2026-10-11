#!/bin/bash

echo "[+] Stopping and removing existing NexusGuard CTF containers & volumes..."
docker compose down -v

echo "[+] Building and starting fresh containers..."
docker compose up -d --build

echo "[+] Waiting for database to initialize..."
sleep 15

echo "[+] Restoring database backup using binary mode..."
docker exec -i nexus_db mysql -u root -pnexus_root_secret --binary-mode=1 ctfd < ctfd_backup.sql

echo "[+] Forcing CTFd setup to complete (Bypassing Setup Wizard)..."
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='true' WHERE \`key\`='setup';"
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='NexusGuard' WHERE \`key\`='ctf_name';"

echo "[+] Restarting CTFd container to apply changes..."
docker restart nexus_ctfd

echo "[+] NexusGuard CTF environment has been successfully reset and restored!"