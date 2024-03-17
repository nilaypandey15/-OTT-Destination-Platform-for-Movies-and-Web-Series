document.addEventListener("DOMContentLoaded", async function() {
    const apiKey = "f100615af72e1ee23615a76da6570e12"; // Replace with your API key
    const carouselBox = document.getElementById("carousel-box");
    const prevBtn = document.getElementById("prevBtn");
    const nextBtn = document.getElementById("nextBtn");

    let page = 1;
    const itemsPerPage = 5;

    // Function to fetch movie data
    async function fetchMovieData() {
        try {
            const response = await fetch(`https://api.themoviedb.org/3/discover/movie?api_key=${apiKey}&page=${page}`);
            const data = await response.json();
            return data.results;
        } catch (error) {
            console.error("Error fetching movie data: ", error);
        }
    }

    // Function to display movie posters in carousel
    async function displayMovies() {
        const movies = await fetchMovieData();
        carouselBox.innerHTML = ""; // Clear existing content

        movies.forEach(movie => {
            const img = document.createElement("img");
            img.src = `https://image.tmdb.org/t/p/w185${movie.poster_path}`;
            carouselBox.appendChild(img);
        });
    }

    // Function to handle next button click
    nextBtn.addEventListener("click", function() {
        page++;
        displayMovies();
    });

    // Function to handle previous button click
    prevBtn.addEventListener("click", function() {
        if (page > 1) {
            page--;
            displayMovies();
        }
    });

    // Initial display
    displayMovies();
});
