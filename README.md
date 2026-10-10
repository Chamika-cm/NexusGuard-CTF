# NexusGuard CTF Platform 🛡️

Official containerized Capture The Flag (CTF) security auditing platform built for the **Penetration Testing (IE3132)** group project.

This repository contains the complete Docker Compose orchestration, CTFd scoreboard integration, and multi-stage security challenges spanning web security, networking, digital forensics, Linux privilege escalation, and capstone tasks.

---

##  System Architecture & Stages

The platform runs on an isolated custom Docker bridge network (`172.28.0.0/16`) and includes the following services:

| Service Name | Container Name | Port | Description / Vulnerability Focus |
| :--- | :--- | :--- | :--- |
| **CTFd Scoreboard** | `nexus_ctfd` | `8000` | Central scoring engine & MariaDB backend |
| **Stage 1 (Web)** | `nexus_stage1` | `8081` | Web Path Traversal & File Inclusion |
| **Stage 2 (Network)** | `nexus_stage2` | `8082` | Network Enumeration & Port Scanning |
| **Stage 3 (Forensics)** | `nexus_stage3` | `8083` | Digital Forensics (PCAP Analysis) |
| **Stage 4 (Web RCE)** | `nexus_stage4` | `8084` | Web Application RCE / Command Injection |
| **Stage 5 (Linux SSH)** | `nexus_stage5` | `2222` | Linux SUID Privilege Escalation |
| **Stage 6 (Root Capstone)** | `nexus_stage6` | `2223` | Advanced Cron Job Hijacking & Root Escalation |

---

##  Getting Started (Prerequisites)

Before running the platform, ensure you have the following installed on your machine:

- **Docker** (Latest version)
- **Docker Compose** (V2+)
- **Git**

---

##  Step-by-Step Installation Guide for Team Members

Follow these steps to clone and run the CTF box locally on your machine.

### 1. Clone the Repository

Open your terminal (Linux/WSL/Command Prompt) and clone this repository:

```bash
git clone https://github.com/YOUR-GITHUB-USERNAME/NexusGuard-CTF-Platform.git
cd NexusGuard-CTF-Platform
```

> **Note:** Replace `YOUR-GITHUB-USERNAME` with the actual GitHub username of the repository owner.

### 2. Build and Start the Docker Environment

Run the following Docker Compose command in detached mode to pull base images, build containers, and establish the custom subnet:

```bash
docker compose up -d --build
```

### 3. Verify Containers are Running

Check if all containers are up and running smoothly without any errors:

```bash
docker ps
```

You should see `nexus_ctfd`, `nexus_db`, and all six stage containers (`nexus_stage1` to `nexus_stage6`) listed with their respective ports.

---

##  Accessing the Platform & Challenges

### CTFd Scoreboard

Open your browser and navigate to:

```text
http://localhost:8000
```

### Individual Stage Access

You can access the individual challenge endpoints using the ports specified in the architecture table above.

Examples:

```text
http://localhost:8081
```

Stage 5 SSH access:

```bash
ssh analyst@localhost -p 2222
```

---

##  Resetting or Cleaning the Environment

If any container crashes, files get corrupted, or you want a fresh start during testing or recording, use the automated reset workflow:

```bash
docker compose down -v
docker system prune -f
docker compose up -d --build
```

---

##  Team Responsibilities & Contributions

- **Member 1:** Infrastructure, Docker Compose Architecture, Network Isolation, and CTFd Deployment.
- **Member 2:** Challenge Design A (Stages 1, 2, 3 — Web Path Traversal, Networking, Forensics).
- **Member 3:** Challenge Design B (Stages 4, 5, 6 — Web RCE, Linux SUID, Capstone Cron Hijack).
- **Member 4:** End-to-End Integration, QA Testing Matrix, Security Audits, and Reset Validation.


---

## 🛠️ Member 3 Contributions & Stage Specifications

Member 3 is responsible for designing, containerizing, and verifying **Stage 4, Stage 5, and Stage 6** of the NexusGuard CTF platform.

### 📍 Stage 4: Web Security (Authenticated Admin RCE)
- **Container Name:** `nexus_stage4`
- **Internal IP:** `172.28.0.14`
- **Port:** `8084`
- **Vulnerability Focus:** Web Portal Command Injection / Authenticated Remote Code Execution (RCE).
- **Access / Verification:**
  - Access via Browser: `http://localhost:8084`
  - Authenticate using admin credentials and execute system commands through the console to retrieve the flag:
    ```bash
    cat /var/www/flag4.txt
    ```

### 📍 Stage 5: Linux System Security (SUID Privilege Escalation)
- **Container Name:** `nexus_stage5`
- **Internal IP:** `172.28.0.15`
- **Vulnerability Focus:** Local Privilege Escalation via SUID binary misconfiguration (`find`).
- **Access / Verification:**
  - Enter the container shell:
    ```bash
    docker exec -it nexus_stage5 bash
    ```
  - Exploit SUID permissions on `/usr/bin/find` to read the root flag:
    ```bash
    find /root/flag5.txt -exec cat {} \;
    ```

### 📍 Stage 6: Advanced Linux Security (Capstone - Cron Execution Compromise)
- **Container Name:** `nexus_stage6`
- **Internal IP:** `172.28.0.16`
- **Vulnerability Focus:** Automated Task Hijacking / Unprivileged Scheduled Job Exploitation.
- **Access / Verification:**
  - Enter the container shell:
    ```bash
    docker exec -it nexus_stage6 bash
    ```
  - Inspect the system cron job configuration:
    ```bash
    cat /etc/cron.d/vulnerable-cron
    ```

---
## Deployment & Reset Instructions (Member 4 - Integration)

**To start the environment:**
1. Navigate to the project directory.
2. Run: `docker compose up -d --build`
3. Wait for the build to complete, then access CTFd at `http://localhost:8000`.

**To import database (If required):**
Run: `docker exec -i nexus_db mysql -u root -pnexus_root_secret ctfd < ctfd_backup.sql`

**To completely reset the environment:**
Run: `docker compose down -v`