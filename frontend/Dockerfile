# Image Node.js
FROM node:18

WORKDIR /app

# Copie des fichiers
COPY package.json package-lock.json ./
RUN npm install

COPY . .

CMD ["npm", "run", "dev"]
