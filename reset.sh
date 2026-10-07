#!/bin/bash

echo "[+] Stopping and removing existing NexusGuard CTF containers & volumes..."
docker compose down -v

echo "[+] Building and starting fresh containers..."
docker compose up -d --build

echo "[+] NexusGuard CTF environment has been successfully reset!"