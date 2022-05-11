class ChartObject {
    static config(
      domId,
      type,
      labels,
      label,
      backgroundColor,
      borderColor,
      data
    ) {
      if (
        typeof domId == "string" &&
        typeof type == "string" &&
        Array.isArray(labels) == true &&
        typeof label == "string" &&
        Array.isArray(backgroundColor) == true &&
        Array.isArray(borderColor) == true &&
        Array.isArray(data) == true
      ) {
        const ctx = document.getElementById(domId).getContext("2d");
        const myChart = new Chart(ctx, {
          type: type,
          data: {
            labels: labels,
            datasets: [
              {
                label: label,
                data: data,
                backgroundColor: backgroundColor,
                borderColor: borderColor,
                borderWidth: 1,
              },
            ],
          },
          options: {
            scales: {
              y: {
                beginAtZero: true,
              },
            },
          },
        });
      } else {
        return false;
      }
    }
  }