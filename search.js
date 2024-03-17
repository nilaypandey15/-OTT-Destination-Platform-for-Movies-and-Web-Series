document.addEventListener("DOMContentLoaded", function() {
    const apiKey = "f100615af72e1ee23615a76da6570e12"; // Remove leading/trailing spaces
    const apiUrl = "https://api.themoviedb.org/3/search/movie";

    const searchForm = document.getElementById("searchForm");
    const searchInput = document.getElementById("searchInput");
    const resultsContainer = document.getElementById("results");

    searchForm.addEventListener("submit", function(event) {
        event.preventDefault();
        
        const searchTerm = searchInput.value.trim();

        // Clear previous search results
        resultsContainer.innerHTML = "";

        // Fetch movie data from the API
        fetch(`${apiUrl}?api_key=${apiKey}&query=${searchTerm}`)
            .then(response => response.json())
            .then(data => {
                if (data.results && data.results.length > 0) {
                    // Display search results
                    data.results.forEach(movie => {
                        const movieElement = document.createElement("div");
                        movieElement.innerHTML = `
                            <h2>${movie.title}</h2>
                            <p>Release Date: ${movie.release_date}</p>
                            <img src="https://image.tmdb.org/t/p/w500${movie.poster_path}" alt="${movie.title} Poster">
                        `;
                        resultsContainer.appendChild(movieElement);
                    });
                } else {
                    // Display error message if no results found
                    resultsContainer.innerHTML = "<p>No results found.</p>";
                }
            })
            .catch(error => {
                console.error("Error fetching data:", error);
                // Display error message if API request fails
                resultsContainer.innerHTML = "<p>An error occurred while fetching data. Please try again later.</p>";
            });
    });
});
