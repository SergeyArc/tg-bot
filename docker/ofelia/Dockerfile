FROM mirror.gcr.io/mcuadros/ofelia:v0.3.4

RUN apk update && apk add gettext bash

ENTRYPOINT []
CMD true \
    && mkdir -p /etc/ofelia \
    && envsubst < /tmp/config.ini > /etc/ofelia/config.ini \
    && cat /etc/ofelia/config.ini \
    && /usr/bin/ofelia daemon --config /etc/ofelia/config.ini
