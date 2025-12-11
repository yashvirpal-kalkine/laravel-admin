# Use the official Node.js image from Docker Hub
FROM node:20

# Set the working directory
WORKDIR /app

# Copy package.json and package-lock.json to the working directory
COPY package*.json ./

# Install the dependencies
RUN npm install

# Copy the rest of the app's source code
COPY . .

# Expose port 3000 for the app
EXPOSE 3000

# Run the app using npm start
CMD ["npm", "start"]
