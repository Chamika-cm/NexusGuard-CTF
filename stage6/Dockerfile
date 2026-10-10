FROM ubuntu:22.04

# OpenSSH, Cron 
RUN apt-get update && apt-get install -y \
    openssh-server \
    cron \
    vim \
    nano \
    sudo \
    && rm -rf /var/lib/apt/lists/*

RUN mkdir /var/run/sshd

# Analyst user 
RUN useradd -m -s /bin/bash analyst && \
    echo "analyst:analyst123" | chpasswd

# Root Flag file 
RUN echo "NEXUS{c4pst0n3_r00t_c0mpr0m1s3_m4st3r}" > /root/flag6.txt && chmod 600 /root/flag6.txt

# Vulnerable script 
RUN mkdir -p /opt/scripts && \
    echo "#!/bin/bash\n# Scheduled cleanup script" > /opt/scripts/cleanup.sh && \
    chmod 777 /opt/scripts/cleanup.sh

# Vulnerable Cron Job 
RUN echo "* * * * * root /opt/scripts/cleanup.sh" > /etc/cron.d/vulnerable-cron && \
    chmod 0644 /etc/cron.d/vulnerable-cron

EXPOSE 22

# SSH & corn 
CMD service cron start && /usr/sbin/sshd -D