#server program
import socket


def server_program():

    host = socket.gethostname()
    port = 8000 

    server_socket = socket.socket()  # socket object
    server_socket.bind((host, port)) 

    server_socket.listen(2)
    conn, address = server_socket.accept()

    while True:
        data = conn.recv(1024).decode()
        if not data:
            break
        print("Counciler: " + str(data))
        data = input('You -> ')
        conn.send(data.encode())  



    conn.close()  


if __name__ == '__main__':
    server_program()