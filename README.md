# php-cdn

API to upload file into a apache + php server.

Send a post to index page with multipart/form-data fields
- file: binary
- path: path inside uploads folder
- name: filename

Pass X-Token header, with token confiured in config.php
