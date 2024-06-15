const TronWeb = require('tronweb');

const tronWeb = new TronWeb({
    fullHost: process.env.TRON_HOST,
    headers: { "TRON-PRO-API-KEY": process.env.TRON_PRO_API_KEY },
    privateKey: process.env.TRON_PRIVATE_KEY,
});

const toAddress = process.env.RECIPIENT_WALLET_ADDRESS;
const transferType = process.env.TRANSFER_TYPE;
const amount = process.env.TRANSFER_AMOUNT * Math.pow(10, 6);

const usdtContractAddress = 'TG3XXyExBkPp9nzdajDZsozEu4BkaSJozs';

async function sendUSDT() {
    try {
        const contract = await tronWeb.contract().at(usdtContractAddress);
        const transaction = await contract.transfer(toAddress, amount).send({
            feeLimit: 30000000, // 30 TRX ~ 4 USDT
        });
        console.log('USDT Transaction successful:', transaction);
    } catch (error) {
        console.error('Error in USDT transaction:', error);
    }
}

async function sendTRX() {
    try {
        const transaction = await tronWeb.trx.sendTransaction(toAddress, amount);
        console.log('TRX Transaction successful:', transaction);
    } catch (error) {
        console.error('Error in TRX transaction:', error);
    }
}

async function sendTokens() {
    if (transferType === 'USDT') {
        await sendUSDT();
    } else if (transferType === 'TRX') {
        await sendTRX();
    } else {
        console.error('Invalid transfer type. Use "USDT" or "TRX".');
    }
}

sendTokens();
