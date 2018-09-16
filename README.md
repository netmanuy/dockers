# Dockers v1

Build the images

docker build -t php-render .

Execute the images locally for testing

docker run -d -p 80:80 php-render:latest