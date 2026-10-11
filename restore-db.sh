#!/bin/bash

echo "[+] Waiting for database to initialize..."
sleep 10

echo "[+] Restoring database backup using binary mode..."
docker exec -i nexus_db mysql -u root -pnexus_root_secret --binary-mode=1 ctfd < ctfd_backup.sql

echo "[+] Forcing all setup and configuration flags in database..."
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='true' WHERE \`key\`='setup';"
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='1' WHERE \`key\`='setup';"
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='NexusGuard' WHERE \`key\`='ctf_name';"
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='users' WHERE \`key\`='user_mode';"

echo "[+] Restarting CTFd container..."
docker restart nexus_ctfd

echo "[+] Waiting for container to boot..."
sleep 6

echo "[+] Re-applying setup bypass to prevent redirection..."
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='true' WHERE \`key\`='setup';"
docker exec -i nexus_db mysql -u root -pnexus_root_secret -e "USE ctfd; UPDATE config SET value='1' WHERE \`key\`='setup';"

echo "[+] Database restore and setup bypass completed!"