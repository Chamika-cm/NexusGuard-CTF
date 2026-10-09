FROM ubuntu:22.04

RUN apt-get update && apt-get install -y vim-common gcc && rm -rf /var/lib/apt/lists/*

# Create flag file
RUN echo "NEXUS{su1d_pr1v_3sc4l4t10n_r00t_2026}" > /root/flag5.txt && chmod 600 /root/flag5.txt

# Create binary with SUID bit set
RUN chmod u+s /usr/bin/find

CMD ["tail", "-f", "/dev/null"]