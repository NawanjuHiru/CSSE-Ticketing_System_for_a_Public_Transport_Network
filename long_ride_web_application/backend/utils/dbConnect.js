import mongoose from "mongoose";
import chalk from "chalk";

const db = mongoose.connection;

const warning = chalk.blue.bgMagenta.bold;
const info = chalk.blue.bgCyan.bold;
const errorMsg = chalk.blue.bgRed.bold;
const success = chalk.blue.bgGreen.bold;

export const connect = () => {
  try {
    mongoose.connect(process.env.MONGO_DB_URI, {
      useNewUrlParser: true,
      useUnifiedTopology: true,
    });
		db.on('connected', () => console.log(info('Connected to the database!😎😊😇')));
    db.on('open', () =>console.log(success('DB connection successful!😁😗🤪')));
	} catch (error) {
		  console.log(error);
		  db.on('error', (err) => console.log(errorMsg('DB connection failed!😡😖🤬')));
    	db.on('diconnected', () => console.log(warning('Database disconnected!😥😔🤫')));
	}
};

export const disconnect = (done) => {
  mongoose.disconnect(done);
};
