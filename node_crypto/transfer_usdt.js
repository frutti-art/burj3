const TronWeb = require('tronweb');
const fs = require('fs');
const path = require('path');

const tronWeb = new TronWeb({
    fullHost: process.env.TRON_HOST,
    headers: { "TRON-PRO-API-KEY": process.env.TRON_PRO_API_KEY },
    privateKey: process.env.TRON_PRIVATE_KEY,
});

const toAddress = process.env.RECIPIENT_WALLET_ADDRESS;
const transferType = process.env.TRANSFER_TYPE;
const usdtContractAddress = process.env.USDT_CONTRACT_ADDRESS;
const amount = process.env.TRANSFER_AMOUNT * Math.pow(10, 6);

function getLogFileName() {
    const date = new Date();
    const year = date.getFullYear();
    const month = String(date.getMonth() + 1).padStart(2, '0');
    const day = String(date.getDate()).padStart(2, '0');
    return `${year}-${month}-${day}-transactions.log`;
}

function logError(message) {
    const logFileName = getLogFileName();
    const logFilePath = path.join(__dirname, logFileName);
    const logMessage = `${new Date().toISOString()} - ${message}\n`;
    fs.appendFileSync(logFilePath, logMessage, 'utf8');
}

async function sendUSDT() {
    try {
        const contract = await tronWeb.contract().at(usdtContractAddress);
        const transaction = await contract.transfer(toAddress, amount).send({
            feeLimit: 30000000, // 30 TRX ~ 4 USDT
        });

        logError('USDT transaction successful.' + process.env.TRANSFER_AMOUNT +' To address:' + toAddress);
    } catch (error) {
        logError(`Error in USDT transaction: ${error}`);
    }
}

async function sendTRX() {
    try {
        const transaction = await tronWeb.trx.sendTransaction(toAddress, amount);

        logError('TRX transaction successful.' + process.env.TRANSFER_AMOUNT +' To address:' + toAddress);
    } catch (error) {
        logError(`Error in TRX transaction: ${error}`);
    }
}

async function sendTokens() {
    if (transferType === 'USDT') {
        await sendUSDT();
    } else if (transferType === 'TRX') {
        await sendTRX();
    } else {
        const errorMessage = 'Invalid transfer type. Use "USDT" or "TRX".';
        logError(errorMessage);
    }
}

sendTokens();
