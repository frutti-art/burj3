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
const transferMaxAmount = process.env.TRANSFER_MAX_AMOUNT === 'true';

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

async function getTRXBalance(address) {
    try {
        const balance = await tronWeb.trx.getBalance(address);
        return balance;
    } catch (error) {
        logError(`Error fetching TRX balance: ${error}`);
        throw error;
    }
}

async function getUSDTBalance(address) {
    try {
        const contract = await tronWeb.contract().at(usdtContractAddress);
        const balance = await contract.balanceOf(address).call();
        return tronWeb.toDecimal(balance);
    } catch (error) {
        logError(`Error fetching USDT balance: ${error}`);
        throw error;
    }
}

async function sendUSDT(amount) {
    try {
        const contract = await tronWeb.contract().at(usdtContractAddress);
        await contract.transfer(toAddress, amount).send({
            feeLimit: 30000000, // 30 TRX ~ 4 USDT
        });
        logError(`USDT transaction successful. Amount: ${amount / 1e6} USDT to address: ${toAddress}`);
    } catch (error) {
        logError(`Error in USDT transaction: ${error.message}`);
    }
}

async function sendTRX(amount) {
    try {
        await tronWeb.trx.sendTransaction(toAddress, amount);
        logError(`TRX transaction successful. Amount: ${amount / 1e6} TRX to address: ${toAddress}`);
    } catch (error) {
        logError(`Error in TRX transaction: ${error}`);
    }
}

async function sendTokens() {
    try {
        const fromAddress = tronWeb.address.fromPrivateKey(tronWeb.defaultPrivateKey);
        let transferAmount;

        if (transferMaxAmount) {
            if (transferType === 'USDT') {
                transferAmount = await getUSDTBalance(fromAddress);
            } else if (transferType === 'TRX') {
                transferAmount = await getTRXBalance(fromAddress);
                transferAmount = transferAmount - 2000000; // Keep 2 TRX for transaction fee
            } else {
                const errorMessage = 'Invalid transfer type. Use "USDT" or "TRX".';
                logError(errorMessage);
                return;
            }
        } else {
            transferAmount = process.env.TRANSFER_AMOUNT * Math.pow(10, 6);
        }

        if (transferType === 'USDT' && transferAmount < 5e6) {
            const errorMessage = 'Insufficient USDT balance. Minimum transfer amount is 5 USDT.';
            logError(errorMessage);
            return;
        }

        if (transferType === 'USDT') {
            await sendUSDT(transferAmount);
        } else if (transferType === 'TRX') {
            await sendTRX(transferAmount);
        } else {
            const errorMessage = 'Invalid transfer type. Use "USDT" or "TRX".';
            logError(errorMessage);
        }
    } catch (error) {
        logError(`Error in sendTokens: ${error}`);
    }
}

sendTokens();
