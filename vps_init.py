import pty
import os
import sys
import time

def setup_vps():
    password = "C9b-MDy-Tu2-9kS"
    ip = "43.156.132.218"
    user = "ubuntu"
    
    # Generate SSH key if not exists
    ssh_key_path = os.path.expanduser("~/.ssh/id_rsa_vps")
    if not os.path.exists(ssh_key_path):
        os.system(f'ssh-keygen -t rsa -b 4096 -f {ssh_key_path} -N ""')
    
    with open(ssh_key_path + ".pub", "r") as f:
        pub_key = f.read().strip()

    # Command to add public key to authorized_keys
    cmd = f"ssh -o StrictHostKeyChecking=no {user}@{ip} 'mkdir -p ~/.ssh && echo \"{pub_key}\" >> ~/.ssh/authorized_keys && chmod 700 ~/.ssh && chmod 600 ~/.ssh/authorized_keys'"
    
    pid, fd = pty.fork()
    if pid == 0:
        os.execvp("ssh", ["ssh", "-o", "StrictHostKeyChecking=no", f"{user}@{ip}", f"mkdir -p ~/.ssh && echo '{pub_key}' >> ~/.ssh/authorized_keys && chmod 700 ~/.ssh && chmod 600 ~/.ssh/authorized_keys"])
    else:
        # Parent process: handle password prompt
        output = b""
        while True:
            try:
                chunk = os.read(fd, 1024)
                if not chunk: break
                output += chunk
                if b"password:" in chunk.lower():
                    os.write(fd, (password + "\n").encode())
                time.sleep(0.1)
            except OSError:
                break
        
        print("Setup complete. Output:")
        print(output.decode(errors='ignore'))

if __name__ == "__main__":
    setup_vps()
