FROM nginx:1.14.1-alpine
MAINTAINER Nick Tsubanov

ENV TERM xterm

COPY app.conf /etc/nginx/sites-available/app.conf
COPY nginx.conf /etc/nginx/nginx.conf

RUN mkdir /etc/nginx/sites-enabled
RUN ln -s /etc/nginx/sites-available/app.conf /etc/nginx/sites-enabled/app

CMD ["nginx", "-g", "daemon off;"]