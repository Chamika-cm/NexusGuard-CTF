from scapy.all import IP, TCP, Raw, wrpcap

# Packet 1: HTTP GET Request (Client -> Server)
req_payload = (
    "GET /admin/login.php HTTP/1.1\r\n"
    "Host: internal.nexusguard.local\r\n"
    "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
    "Authorization: Basic YWRtaW46TmV4dXNHdWFyZEAyMDI2IQ==\r\n\r\n"
)
pkt1 = IP(src="192.168.1.50", dst="172.28.0.13")/TCP(sport=49152, dport=80, flags="PA", seq=1000, ack=1)/Raw(load=req_payload)

# Packet 2: HTTP 200 OK Response with Flag (Server -> Client)
res_payload = (
    "HTTP/1.1 200 OK\r\n"
    "Server: Apache/2.4.50\r\n"
    "Content-Type: text/plain\r\n\r\n"
    "LOGIN SUCCESSFUL!\r\n"
    "Stage 3 Flag: NEXUS{pc4p_cl34rt3xt_cr3d3nt14ls}\r\n\r\n"
    "Stage 4 Admin Credentials:\r\n"
    "Username: admin_nexus\r\n"
    "Password: NexusAdmin#2026!Secured\r\n"
)
pkt2 = IP(src="172.28.0.13", dst="192.168.1.50")/TCP(sport=80, dport=49152, flags="PA", seq=1, ack=1000+len(req_payload))/Raw(load=res_payload)

# Save both packets to PCAP
wrpcap("stage3/incident.pcap", [pkt1, pkt2])
print("Updated PCAP generated with HTTP Response & Flag!")