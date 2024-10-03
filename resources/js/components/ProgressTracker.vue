<template>
    <div>
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <input type="text" v-model="searchQuery" class="form-control custom-search-input" placeholder="Search...">
            <select v-model="selectedFilter" class="form-control filter-box">
                <option value="">All</option>
                <option v-for="option in filterOptions" :key="option" :value="option">{{ option }}</option>
            </select>
        </div>

        <div class="table-responsive table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th v-for="(header, index) in headers" :key="header" :class="getColumnClass(index)">{{ header }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in filteredAndSearchedRows" :key="index">
                        <td v-for="(item, idx) in row" :key="idx" :class="getColumnClass(idx)">
                            <div v-if="Array.isArray(item)">
                                <div v-for="(subItem, subIdx) in item" :key="subIdx" class="cell-content">{{ subItem }}</div>
                            </div>
                            <div v-else>{{ item }}</div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="pagination">
            <button @click="prevPage" :disabled="currentPage === 1">Previous</button>
            <span v-for="page in totalPages" :key="page">
                <button 
                    @click="goToPage(page)" 
                    :class="{ active: currentPage === page }" 
                    class="page-number-button"
                >
                    {{ page }}
                </button>
            </span>
            <button @click="nextPage" :disabled="currentPage === totalPages">Next</button>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        initialJson: Array,
        headers: Array
    },
    data() {
        return {
            rows: this.initialJson,
            searchQuery: '',
            selectedFilter: '',
            filterOptions: ['CAMP', 'CAS', 'CD', 'CN', 'CM', 'CP', 'CPH'],
            currentPage: 1,
            perPage: 3
        };
    },
    computed: {
        filteredAndSearchedRows() {
            let filtered = this.rows;

            // Apply filter by college unit (if selected)
            if (this.selectedFilter) {
                filtered = filtered.filter(row => row.some(item => item.includes(this.selectedFilter)));
            }

            // Apply search
            if (this.searchQuery) {
                filtered = filtered.filter(row =>
                    row.some(item => item.toString().toLowerCase().includes(this.searchQuery.toLowerCase()))
                );
            }

            // Apply pagination
            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return filtered.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.rows.length / this.perPage);
        }
    },
    methods: {
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
            }
        },
        goToPage(page) {
            this.currentPage = page;
        },
        getColumnClass(index) {
            // Define colors for each source category
            const columnCategories = [
                { color: 'accomplishments', range: [0, 1] }, // Accomplishments
                { color: 'billings', range: [2, 4] }, // Billings
                { color: 'projects', range: [5, 6] }, // Projects
                { color: 'status', range: [7, 9] }, // Status
                { color: 'project_contractor', range: [10, 15] }, // Project Contractor
                { color: 'projects_2', range: [16, 19] }, // Projects (again)
                { color: 'fund_sources', range: [20, 22] }, // Fund Sources
                { color: 'billings_2', range: [23, 24] }, // Billings (again)
                { color: 'change_orders', range: [25, 27] }, // Change Orders
                { color: 'activities', range: [29, 36] }, // Activities
                { color: 'recent_updates', range: [41, 43] } // Recent Updates
            ];

            for (const category of columnCategories) {
                if (index >= category.range[0] && index <= category.range[1]) {
                    return category.color;
                }
            }
            return '';
        }
    }
};
</script>

<style scoped>
/* General styles for table */
.table-container {
    margin-top: 20px;
}

/* Distinct column colors based on source */
.accomplishments {
    background-color: rgba(249, 194, 255, 0.35); /* Light purple with transparency */
}
.billings {
    background-color: rgba(194, 249, 255, 0.35); /* Light blue with transparency */
}
.projects {
    background-color: rgba(194, 255, 179, 0.35); /* Light green with transparency */
}
.status {
    background-color: rgba(255, 236, 179, 0.35); /* Light yellow with transparency */
}
.project_contractor {
    background-color: rgba(255, 179, 179, 0.35); /* Light red with transparency */
}
.fund_sources {
    background-color: rgba(224, 224, 224, 0.35); /* Light gray with transparency */
}
.change_orders {
    background-color: rgba(255, 230, 179, 0.35); /* Light orange with transparency */
}
.activities {
    background-color: rgba(209, 196, 233, 0.35); /* Light lavender with transparency */
}
.recent_updates {
    background-color: rgba(255, 204, 188, 0.35); /* Light coral with transparency */
}

/* Pagination styles */
.pagination {
    display: flex;
    justify-content: center; /* Center the pagination buttons */
    align-items: center;
    margin: 1rem 0; /* Add some margin for spacing */
}

.page-number-button {
    margin: 0 5px; /* Space between buttons */
    padding: 5px 10px; /* Button padding */
}

.page-number-button.active {
    font-weight: bold;
    background-color: #007bff; /* Active button color */
    color: white; /* Active button text color */
}
</style>
