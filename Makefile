LESS=/usr/bin/lessc
PHP=/usr/bin/php
UGLIFY=/usr/bin/uglifyjs.terser

install:
	clear
	composer install
	composer dump-autoload
	sudo touch db/db.sqlite3
	sudo chmod -R 777 db
	$(PHP) bin/mig.php
	$(LESS) less/style.less public/css/style.css --clean-css
	$(UGLIFY) js/inc/jquery.js js/script.js --output public/js/script.js --compress
	echo "pronto!"