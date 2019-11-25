FROM node:latest
WORKDIR /home/node/app

COPY package*.json ./

RUN npm install
RUN npm install -g @vue/cli

ENV PATH /home/node/app/node_modules/.bin:$PATH

CMD npm run serve
