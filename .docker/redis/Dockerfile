FROM redis:5.0.3-alpine

#ADD start.sh /start.sh
#RUN chmod 755 /start.sh
COPY redis.conf /usr/local/etc/redis/redis.conf
RUN chmod 755 /usr/local/etc/redis/redis.conf
#RUN mkdir /tmp/redis
#RUN chmod 766 /tmp/redis
CMD [ "redis-server", "/usr/local/etc/redis/redis.conf" ]