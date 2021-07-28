FROM node:15-alpine

RUN mkdir -p /home/node/app/node_modules && chown -R node:node /home/node/app

WORKDIR /home/node/app

COPY --chown=node:node ./package.json ./
COPY --chown=node:node ./tsconfig.json ./
COPY --chown=node:node ./package-lock.json ./
COPY --chown=node:node ./webpack.mix.js ./

RUN npm install

COPY tsconfig.json ./

COPY --chown=node:node ./theme ./theme

CMD [ "npm", "run", "watch" ]
