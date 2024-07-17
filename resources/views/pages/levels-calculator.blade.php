<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Governance Rewards Estimator</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .slider-container {
            position: relative;
            width: 100%;
            margin-top: 1.5rem; /* Add top margin for the slider */
            margin-bottom: 2rem; /* Add bottom margin for the slider */
        }
        .slider-value {
            position: absolute;
            top: 2rem; /* Position the labels below the slider */
            color: white;
            transform: translateX(-50%);
        }
        .slider-min {
            left: 0;
            transform: translateX(0); /* Align the min value to the left */
        }
        .slider-max {
            right: 0;
            transform: translateX(0); /* Align the max value to the right */
        }
    </style>
</head>
<body class="bg-slate-50 text-white flex justify-center items-center h-screen">
<div class="bg-[#121B25] p-8 md:p-16 rounded-xl md:rounded-3xl shadow-lg w-full md:w-1/2">
    <h1 class="text-4xl font-semibold mb-4">Investment calculator</h1>
    <div class="mb-16">
        <label for="stake" class="block text-lg mb-2">You invest <span id="stake-value" class="font-semibold">{{ $levels[1]->upgrade_cost }}</span> USDT</label>
        <div class="slider-container">
            <input id="stake" type="range" min="0" max="{{ $levels->count() - 1 }}" value="1" class="w-full" style="accent-color: white">
            <span class="slider-value slider-min">{{ $levels[0]->upgrade_cost }} USDT</span>
            <span class="slider-value slider-max">{{ $levels[$levels->count() - 1]->upgrade_cost }} USDT</span>
        </div>
    </div>
    <div class="bg-[#D6FFDA] text-black p-4 md:p-6 rounded-lg flex flex-col md:flex-row justify-between">
        <div class="mb-4 md:mb-0">
            <p>Your estimated rewards</p>
            <p class="text-3xl md:text-4xl font-medium"><span id="estimated-rewards">{{ $levels[1]->daily_return_amount * 90 }}</span> USDT</p>
        </div>
        <div>
            <p>Bonus from investment</p>
            <p class="text-3xl md:text-4xl font-medium"><span id="estimated-bonus">{{ round((($levels[1]->daily_return_amount * 90) - $levels[1]->upgrade_cost) / $levels[1]->upgrade_cost * 100, 2) }}</span> %</p>
        </div>
    </div>
</div>

<script>
    const stakeInput = document.getElementById('stake');
    const stakeValueDisplay = document.getElementById('stake-value');
    const estimatedRewardsDisplay = document.getElementById('estimated-rewards');
    const estimatedBonus = document.getElementById('estimated-bonus');
    const levelsArray = @json($levels->toArray());

    stakeInput.addEventListener('input', (event) => {
        const stake = event.target.value;
        const estimatedRewards = levelsArray[stake].daily_return_amount * 90;
        const upgradeCost = levelsArray[stake].upgrade_cost;
        const bonusPercentage = ((estimatedRewards - upgradeCost) / upgradeCost * 100).toFixed(2);

        stakeValueDisplay.textContent = upgradeCost;
        estimatedRewardsDisplay.textContent = estimatedRewards.toLocaleString();
        estimatedBonus.textContent = bonusPercentage;
    });
</script>
</body>
</html>
