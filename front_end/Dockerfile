FROM node:latest
WORKDIR /home/node/app

ENV PATH /home/node/app/node_modules/.bin:$PATH
COPY package.json .
COPY package-lock.json .

RUN npm install
RUN npm install -g @vue/cli

CMD npm run serve
