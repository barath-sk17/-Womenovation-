#client program
import socket


def client_program():
    host = socket.gethostname() 
    port = 8000 

    client_socket = socket.socket()  
    client_socket.connect((host, port)) 

    message = input("You -> ") 

    while message.lower().strip() != 'bye':
        client_socket.send(message.encode()) 
        data = client_socket.recv(1024).decode()  

        print('User: ' + data) 

        message = input(" -> ") 

    client_socket.close() 


if __name__ == '__main__':
    client_program()