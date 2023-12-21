LESS=/usr/bin/lessc
PHP=/usr/bin/php
UGLIFY=/usr/bin/uglifyjs.terser

install:
	clear
	composer install
	composer dump-autoload
	$(PHP) bin/mig.php
	$(LESS) less/style.less public/css/min.css --clean-css
	$(UGLIFY) js/inc/jquery.js js/script.js --output public/js/min.js --compress
	echo "pronto!"