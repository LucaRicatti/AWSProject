<?php
session_start();

if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
	header("Location: ./login/index.php");
	return;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Kanit:wght@400;500&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
	<title>Progetto AWS</title>
</head>
<body>
	<div class="header" id="header">
		<h1>Creazione di un sito tramite server AWS</h1>
	</div>
	<div class="container">
		<div class="chapters-container">
			<a class="chapter-title selected" href="#">Inizializzazione di AWS</a>
			<a class="chapter-title" href="#section2">Connesione con AWS</a>
			<a class="chapter-title" href="#section3">Installazione di Docker</a>
			<a class="chapter-title" href="#section4">Configurazione di Nginx</a>
			<a class="chapter-title" href="#section5">Creazione del Sito</a>
			<a class="chapter-title" href="#section6">Configurazione di MariaDB</a>
			<a class="chapter-title" href="#section7">Creazione del database</a>
		</div>
		<div class="section" id="section1">
			<h2>Inizializzazione di AWS</h2>
			Per creare un sito con AWS prima bisogna creare un istanza su AWS
			<p>
				Una volta eseguito l'accesso nella <a target="_blank" href="https://us-east-1.console.aws.amazon.com/ec2/home?region=us-east-1#Instances:">console di Amazon AWS</a>, entrare nella dashboard EC2. Una volta dentro seguire i seguenti passaggi per creare una nuova istanza:
				<p>
					1. Seleziona "Avvia istanza" dal pannello di controllo. <br>
					2. Imposta un nome all'istanza. <br>
					3. Scegliere un sistema operativo per l'istanza, in questo caso verrà scelto Ubuntu. <br>
					<img style="width: 50%;" src="../imgs/instance1.png"> <br>
					4. Creare le chiavi che servono ad accedere al server da remoto. <br>
					<img style="width: 50%;" src="../imgs/instance2.png">
				</p>
				<br>
				<p>
					Una volta impostati questi valori cliccare su Lancia Istanza per creare la nuova istanza.<br>
					Successivamente bisogna modificare le regole del firewall. Per fare questo, selezionare l'istanza creata ed andare nella sezione Sicurezza per poi selezionare i gruppi sicurezza (sg-...).<br>
					<img style="width: 60%;" src="../imgs/instance3.png">
					Nelle regole di entrata cliccare su Modifica regole di entrata per iniziare a modificare le regole.<br>
				</p>
				<br>
				<p>
					Per aggiungere nuove regole cliccare su Aggiungi Regola.<br>
					Una volta agginta la regola selezionare il tipo HTTP per la prima regola e HTTPS per la seconda. In entrambe le regole impostare la sorgente come "0.0.0.0/0"<br>
					<img style="width: 90%;" src="../imgs/instance4.png">
				</p>
			</p>
		</div>
		<div class="section" id="section2">
			<h2>Connesione con AWS</h2>
			<p>
				Per connettersi al server creato bisogna utilizzare un client SSH. In questo caso verrà utilizzato <a target="_blank" href="https://www.putty.org">PuTTy</a>. <br>
				Per prima cosa tornare nella lista delle istanza create nella console di AWS e copiare l'indirizzo IP dell'istanza creata. Questo servirà per connettersi al server tramite PuTTY. <br>
				Incollare l'indirizzo IP nel campo "Host Name (or IP address)" nella sezione "Session" nell'interfaccia di PuTTy. <br>
				<img style="width: 40%;" src="../imgs/putty1.png"> <br>
			</p>
			<br>
			<p>
				Successivamente andare nella sezione Connection -> SSH ->  Auth -> Credentials. Qui selezionare il "Browse" nel campo "Private key file for authentication" e selezionare la chiave creata precedentemente. <br>
				<img style="width: 40%;" src="../imgs/putty2.png"> <br>
			</p>
		</div>
		<div class="section" id="section3">
			<h2>Installazione di Docker</h2>
			<p>
				Prima di creare il sito bisogna installare Docker. Per prima cosa bisogna aggiornare APT con i seguenti comandi:
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">$</div>
					<div class="text">sudo apt update</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">$</div>
					<div class="text">sudo apt upgrade</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>
				Successivamente si può installare Docker utilizzando il seguente comando: <br>
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">$</div>
					<div class="text">sudo apt install docker.io</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>
				E docker-compose:
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">$</div>
					<div class="text">sudo apt install docker-compose</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>
				docker-compose verrà utilizzato per gestire i vari Docker container. <br>
				Tramite Docker, installare Nginx, che verrà utilizzato per hostare il sito sull'istanza AWS
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">$</div>
					<div class="text">docker pull nginx</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
		</div>
		<div class="section" id="section4">
			<h2>Configurazione di Nginx</h2>
			<p>
				Una volta installato Docker, docker-compose e Nginx, si può iniziare a creare i file che verranno utilizzati per l'hosting del sito. <br>
				Per prima cosa bisogna creare una cartella che conterrà il progetto. Per farlo usare il seguente comando:
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">$</div>
					<div class="text">mkdir project</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">$</div>
					<div class="text">cd project/</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Creare un altra cartella dentro la cartella del progetto che conterrà il codice del sito.</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">mkdir php</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>All'interno della cartella creare un file chiamato "Dockerfile". Questo file servirà a contenere la configurazione per la creazione del servizio per PHP.</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">cd php/</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/php $</div>
					<div class="text">touch Dockerfile</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Per scrivere nel file "docker-compose.yml" utilizzare l'editor di testo "nano" o qualsiasi altro editor.</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/php $</div>
					<div class="text">sudo nano Dockerfile</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Inserire il seguente codice all'interno di "Dockerfile":</p>
			<code>
				<div class="code-text-container">
					<pre class="text">
FROM php:7.4-fpm
WORKDIR /var/www/html
COPY . .
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-enable mysqli</pre>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Una volta creato il Dockerfile dentro la cartella "php" tornare indietro alla cartella del progetto per poi creare un file chiamato "docker-compose.yml". <br>
				Per creare il file usare il comando:</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/php $</div>
					<div class="text">cd ..</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">touch docker-compose.yml</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">sudo nano docker-compose.yml</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<pre class="text">
services:
	nginx:
		build: ./nginx/
		ports:
			- "80:80"
			- "443:443"

		volumes:
			- ./nginx/default.conf:/etc/nginx/conf.d/default.conf
			- ./php:/var/www/html
			- ./nginx/ssl:/etc/nginx/ssl

	php:
		build: ./php/
		expose:
			- "9000"
		volumes:
			- ./php/:/var/www/html/


	db:
		image: mariadb
		volumes:
			-    mysql-data:/var/lib/mysql
		environment:
			MYSQL_ROOT_PASSWORD: mariadb
			MYSQL_DATABASE: AWS

volumes:
	mysql-data:</pre>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>
				Questa configurazione farà funzionare il container Nginx sulla porta 80 per HTTP e 443 per HTTPS. <br>
				Dopo aver impostato la configurazione bisogna creare la cartella nginx e il Dockerfile dentro la cartella nginx. Il Dockerfile verrà utilizzato per contenere la configurazione per la creazione del servizio Nginx. <br>
				Per farlo seguire i passagi:
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">mkdir nginx</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">cd nginx/</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Per far si che il sito funzioni in https con ssl bisogna creare dei certificati. Per farlo prima creare la cartella che conterrà i certificati:</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/nginx $</div>
					<div class="text">mkdir ssl</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>E poi utilizzare il seguente comando per creare un certificato "self-made"</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/nginx $</div>
					<div class="text">openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /ssl/cert.key -out /ssl/cert.pem</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Questo comando creerà un certificato "self-made" valido per un anno. Una volta creato il certificato, creare il "Dockerfile" e il "default.conf":</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/nginx $</div>
					<div class="text">touch Dockerfile</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/nginx $</div>
					<div class="text">touch default.conf</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>
				Prima cosa modificare il "Dockerfile" per creare il servizio nginx.
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/nginx $</div>
					<div class="text">sudo nano Dockerfile</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<pre class="text">
FROM nginx
COPY ./default.conf /etc/nginx/conf.d/default.conf</pre>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>
				Successivamente modificare il file "default.conf" per permettere al sito di essere visualizzato.
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/nginx $</div>
					<div class="text">sudo nano default.conf</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<pre class="text">
server {
	listen 80;
	return 301 https://$host$request_uri;
}

server {
	listen 443 ssl default_server;

	root /var/www/html;
	index index.php index.html;

	ssl_certificate /etc/nginx/ssl/cert.pem;
	ssl_certificate_key /etc/nginx/ssl/cert.key;

	location / {
		try_files $uri $uri/ =404;
	}

	location ~ \.php$ {
		include fastcgi_params;
		fastcgi_pass php:9000;
		fastcgi_index index.php;
		fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
	}

	location ~ \.css {
		add_header Content-Type text/css;
	}

	location ~ \.js {
		add_header Content-Type application/x-javascript;
	}

	error_page 404 /404.html;
	location = /404.html {
		internal;
	}
}</pre>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">project/nginx $</div>
					<div class="text">cd ..</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
		</div>
		<div class="section" id="section5">
			<h2>Creazione del Sito</h2>
			<p>
				Per creare il sito si possono seguire 2 modi: <br>
				1. Nella cartella "php" creare i file che comporranno il sito, come "index.php" etc., e modificarli utilizzando i comandi "touch" e "nano". <br>
				2. Clonare i file del sito direttamente da github. <br>
			</p>
			<p>In questo caso verranno clonati i file dalla repository su github nella cartella "php" utilizzando il seguente comando:</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">git clone https://github.com/Username/Repository.git php/</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Dopo aver clonato la repository tutti i file dovrebbero essere presenti nella cartella "php" del progetto.</p>
		</div>
		<div class="section" id="section6">
			<h2>Configurazione di MariaDB</h2>
			<p>
				MariaDB è Database management system che serve appunto a gestire i database. <br>
				Per prima cosa bisogna avviare i Docker container creati in precedenza utilizzando il seguente comando:
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">sudo docker-compose up -d</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Per verificare che tutti i container sono stai avviati correttamente utilizzare:</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">sudo docker ps</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>
				Dovrebbero essere visualizzati 3 container: Uno per nginx, uno per php e uno per MariaDB. <br>
				Ora si può creare una sessione per gestire il container di MariaDB con il seguente comando:
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">project $</div>
					<div class="text">sudo docker exec -it project-db-1 /bin/sh</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Per creare un utente che potrà accedere al database bisogna prima accedere come root, creare l'utente e dargli i permessi. In questo caso verrà creato un utente chiamato "admin" e che avrà tutti i permessi.</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">#</div>
					<div class="text">mariadb -u root -pmariadb</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">MariaDB [(none)]></div>
					<div class="text">CREATE USER 'admin' IDENTIFIED BY 'password';</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<code>
				<div class="code-text-container">
					<div class="prefix">MariaDB [(none)]></div>
					<div class="text">GRANT ALL PRIVILEGES ON *.* TO 'admin';</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Ricaricare le varie cache interne per salvare i nuovi privilegi:</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">MariaDB [(none)]></div>
					<div class="text">FLUSH PRIVILEGES;</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Ora si può accedere a MariaDB utilizzando il nuovo utente creato (in questo caso non è necessario):</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">#</div>
					<div class="text">mariadb -u admin -ppassword</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Dopo questi passaggi MariaDB dovrebbe essere configurato e si può passare alla creazione del database.</p>
		</div>
		<div class="section" id="section7">
			<h2>Creazione del database</h2>
			<p>
				Per creare il database si dovranno utilizzare le query base di SQL. In questo caso verrà creato un database chiamato 'AWS' che conterrà una tabella chiamata 'utenti'. <br>
				Per creare il database utilizzare la seguente query:
			</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">MariaDB [(none)]></div>
					<div class="text">CREATE TABLE AWS;</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Entrare nel database:</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">MariaDB [(none)]></div>
					<div class="text">USE AWS;</div>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Creare la tabella 'utenti':</p>
			<code>
				<div class="code-text-container">
					<div class="prefix">MariaDB [AWS]></div>
					<pre class="text">
CREATE TABLE utenti (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	email VARCHAR(50) NOT NULL,
	password CHAR(32) NOT NULL
);</pre>
				</div>
				<button class="copy-button">
					<span class="material-symbols-rounded">content_copy</span>
				</button>
			</code>
			<p>Una volta creata la tabella si può usare il comando exit per uscire da MariaDB, per poi utilizzare la combinazione "CTRL + D" per chiudere la sessione creata in precedenza.</p>
		</div>
		<div class="filler"></div>
	</div>
</body>
<script src="script.js"></script>
</html>
