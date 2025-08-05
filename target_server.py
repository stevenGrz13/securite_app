```python
     from http.server import BaseHTTPRequestHandler, HTTPServer

     class TargetHandler(BaseHTTPRequestHandler):
         def do_GET(self):
             self.send_response(200)
             self.send_header("Content-type", "text/plain")
             self.end_headers()
             with open("target_requests.log", "a") as f:
                 f.write(f"Requête reçue à {self.path}\n")
             self.wfile.write(b"OK")

     try:
         server = HTTPServer(("localhost", 8081), TargetHandler)
         print("Cible démarrée sur http://localhost:8081")
         server.serve_forever()
     except OSError as e:
         print(f"Erreur : {e}")
         print("Vérifiez si le port 8081 est utilisé.")
     ```