FROM mirror.gcr.io/postgres:12.3-alpine

ENV POSTGRES_HOST=localhost
ENV POSTGRES_PORT=5432
ENV POSTGRES_DB=test_db
ENV POSTGRES_USER=test_db_user
ENV POSTGRES_PASSWORD=test_db_password

RUN echo "${POSTGRES_HOST}:${POSTGRES_PORT}:${POSTGRES_DB}:${POSTGRES_USER}:${POSTGRES_PASSWORD}" > ~/.pgpass
RUN chmod 600 ~/.pgpass
