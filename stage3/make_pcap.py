from scapy.all import IP, TCP, Raw, wrpcap

payload = (
    "GET /admin/login.php HTTP/1.1\r\n"
    "Host: internal.nexusguard.local\r\n"
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
    "Authorization: Basic YWRtaW46TmV4dXNBZG1pbiMyMDI2IVNlY3VyZWQ=\r\n"
    "HTTP/1.1 200 OK\r\n"
    "Content-Type: text/plain\r\n\r\n"
    "LOGIN SUCCESSFUL!\r\n"
    "Stage 3 Flag: NEXUS{pc4p_cl34rt3xt_cr3d3nt14ls}\r\n"
    "Stage 4 Admin Credentials:\r\n"
    "Username: admin_nexus\r\n"
    "Password: NexusAdmin#2026!Secured\r\n"
)

pkt = IP(src="192.168.1.50", dst="172.28.0.13")/TCP(sport=49152, dport=80, flags="PA")/Raw(load=payload)
wrpcap("incident.pcap", pkt)
print("Valid Binary PCAP File Generated Successfully!")