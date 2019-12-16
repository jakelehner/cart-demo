FROM node:12.13.1

# Set to a non-root built-in user `node`
USER node

RUN mkdir -p /home/node/app
WORKDIR /home/node/app

COPY --chown=node package*.json ./
RUN npm install

COPY --chown=node . .

RUN npm install
#RUN npm install -g @vue/cli

ENV PATH /home/node/app/node_modules/.bin:$PATH

CMD npm run serve
