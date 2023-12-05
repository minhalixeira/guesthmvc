LESS=/usr/bin/lessc
PHP=/usr/bin/php
UGLIFY=/usr/bin/uglifyjs.terser

install: bin/mig.php less/style.less
	clear
	$(PHP) bin/mig.php
	$(LESS) less/style.less public/css/style.css --clean-css
	echo "pronto!"
	$(UGLIFY) js/script.js --output public/js/script.js --compress
