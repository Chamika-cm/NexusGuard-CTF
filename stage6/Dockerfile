FROM ubuntu:22.04

RUN apt-get update && apt-get install -y cron && rm -rf /var/lib/apt/lists/*

RUN echo "NEXUS{cr0n_3x3cut10n_c0mpr0m1s3_2026}" > /root/flag6.txt && chmod 600 /root/flag6.txt

# Setup cron script
RUN mkdir -p /opt/scripts && \
    echo '#!/bin/bash\n# Periodic cleanup script' > /opt/scripts/cleanup.sh && \
    chmod 777 /opt/scripts/cleanup.sh

RUN echo "* * * * * root /opt/scripts/cleanup.sh" > /etc/cron.d/vulnerable-cron && \
    chmod 0644 /etc/cron.d/vulnerable-cron

CMD ["cron", "-f"]