import Chart from 'chart.js';

let propertyBookingsCanvas = document.getElementById('propertyBookings');
let propertySalesCanvas = document.getElementById('propertySales');
let expensesSalesCanvas = document.getElementById('expenses');
let examplePropertyBookingsData = {
    labels: [
        "Example Property",
        "One Property",
        "Two Property"
    ],
    datasets: [
        {
            data: [300, 50, 100],
            backgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
            ],
            hoverBackgroundColor: [
                "#FF6384",
                "#36A2EB",
                "#FFCE56"
            ]
        }]
};

let examplePropertySalesData = {
    labels: [
        "December",
        "January",
        "February"
    ],
    datasets: [
        {
            data: [1, 2, 4],
            backgroundColor: [
                "#FF2001",
                "#34AE10",
                "#FFCE56"
            ],
            hoverBackgroundColor: [
                "#FF2001",
                "#34AE10",
                "#FFCE56"
            ]
        }]
};

let exampleExpensesData = {
    labels: [
        "December",
        "January",
        "February"
    ],
    datasets: [
        {
            data: [1500, 9000, 20000],
            backgroundColor: [
                "#FF4220",
                "#B41F10",
                "#FFCE56"
            ],
            hoverBackgroundColor: [
                "#FF4220",
                "#B41F10",
                "#FFCE56"
            ]
        }]
};

let propertyBookingsChart = new Chart(propertyBookingsCanvas, {
	type: "doughnut",
	data: examplePropertyBookingsData,
	animation: {
		animationScale: true
	}
});
let propertySalesChart = new Chart(propertySalesCanvas, {
	type: "doughnut",
	data: examplePropertySalesData,
	animation: {
		animationScale: true
	}
});

let expensesChart = new Chart(expensesSalesCanvas, {
	type: "doughnut",
	data: exampleExpensesData,
	animation: {
		animationScale: true
	}
});