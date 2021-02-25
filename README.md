# Haarlem Festival
This website was made by the students of *Inholland Haarlem*, following the *Information Technology* course.

## Requirements
The working directory makes use of gulp 3.9 for task running and the local development enviorement.<br/>
This gulp version is incompatible with 'newer' node versions. Please download node version 8.16.2, or install [nvm](https://github.com/coreybutler/nvm-windows#node-version-manager-nvm-for-windows) to change the version of the working directory.

| Application Name | Version |
|------------------|---------|
| php              | >v7.4   |
| node             | v8.16.2 |
| nvm              |         |

## Usage
Please follow the instructions provided to run the application:

1. Download [Node](https://nodejs.org/en/download/) to be able to install the node_modules packages
<br/>If you think you already installed it, try running `node -v` and `npm -v` in your terminal to check if it is installed.
2. If you need to downscale the node version, please download
[nvm](https://github.com/coreybutler/nvm-windows#node-version-manager-nvm-for-windows) and install node version 8.16.2
3. Clone the repository
4. Open the project in VS Code and open the integrated terminal.<br/>Or if your IDE does not have an integraded terminal, go to the location of the project in the terminal provided by your OS
5. If you need to downscale your node version run `nvm use 8.16.2` in the project location
6. Install the node_modules packages with `npm i` or `npm install`
7. Run the application with `gulp dev` or `npm run dev`.<br/>To close it press `ctrl + c`.
