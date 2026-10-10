FROM ubuntu:22.04

# OpenSSH Server 
RUN apt-get update && apt-get install -y \
    openssh-server \
    vim-common \
    gcc \
    sudo \
    && rm -rf /var/lib/apt/lists/*

# SSH run 
RUN mkdir /var/run/sshd

# Analyst user 
RUN useradd -m -s /bin/bash analyst && \
    echo "analyst:analyst123" | chpasswd

# Flag file
RUN echo "NEXUS{su1d_pr1v1l3g3_3sc4l4t10n_root}" > /root/flag5.txt && chmod 600 /root/flag5.txt

# SUID bit 
RUN chmod u+s /usr/bin/find

# SSH Port 
EXPOSE 22

# SSH Daemon 
CMD ["/usr/sbin/sshd", "-D"]