<template>
     <div class="mb-4 d-flex justify-content-between align-items-center">
        <input
            type="text"
            v-model="searchQuery"
            class="form-control custom-search-input"
            placeholder="Search..."
        />
        <select v-model="selectedFilter" class="form-control filter-box">
            <option value="">College Unit</option>
            <option v-for="option in filterOptions" :key="option" :value="option">{{ option }}</option>
        </select>
        <select v-model="dateSortOrder" class="form-control filter-box" @change="sortData">
            <option value="">Date</option>
            <option value="newest">Newest to Oldest</option>
            <option value="oldest">Oldest to Newest</option>
        </select>
        <select v-model="percentageSortOrder" class="form-control filter-box" @change="sortData">
            <option value="">Accomplishment Percentage</option>
            <option value="highest">Highest to Lowest</option>
            <option value="lowest">Lowest to Highest</option>
        </select>
        <button @click="resetFilters" class="btn btn-secondary">Reset</button>
    </div>


        <div class="table-responsive table-container">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th v-for="(header, index) in headers" :key="header" class="header-title custom-width-{{ index }}">
                            {{ header }}
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(row, index) in filteredAndSearchedRows" :key="index">
                        <td v-for="(item, idx) in row" :key="idx" :class="['cell-content', getColumnClass(idx), 'custom-width-' + idx]">
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
            <button @click="prevPage" :disabled="currentPage === 1">... Previous</button>
            <span v-for="page in totalPages" :key="page">
                <button @click="goToPage(page)" :class="{ active: currentPage === page }" class="page-number-button">
                    {{ page }}
                </button>
            </span>
            <button @click="nextPage" :disabled="currentPage === totalPages">Next ...</button>
        </div>

</template>

<script>
export default {
    props: {
        initialJson: Array,
        headers: Array,
    },
    data() {
        return {
            rows: this.initialJson,
            searchQuery: '',
            selectedFilter: '',
            dateSortOrder: '',
            percentageSortOrder: '',
            filterOptions: ['CAMP', 'CAS', 'CD', 'CN', 'CM', 'CP', 'CPH'],
            currentPage: 1,
            perPage: 3,
        };
    },
    computed: {
        filteredAndSearchedRows() {
            let filtered = this.rows;

            if (this.selectedFilter) {
                filtered = filtered.filter(row => row.some(item => item.includes(this.selectedFilter)));
            }

            if (this.searchQuery) {
                filtered = filtered.filter(row =>
                    row.some(item => item.toString().toLowerCase().includes(this.searchQuery.toLowerCase()))
                );
            }

            if (this.dateSortOrder) {
                filtered.sort((a, b) => {
                    const dateA = new Date(a[6]); 
                    const dateB = new Date(b[6]); 
  
                    return this.dateSortOrder === 'newest' ? dateB - dateA : dateA - dateB;
                });
            }

            if (this.percentageSortOrder) {
                filtered.sort((a, b) => {
                    const percentageA = parseFloat(a[0]) || 0; 
                    const percentageB = parseFloat(b[0]) || 0;
                    return this.percentageSortOrder === 'highest' ? percentageB - percentageA : percentageA - percentageB;
            });
}

            const start = (this.currentPage - 1) * this.perPage;
            const end = start + this.perPage;
            return filtered.slice(start, end);
        },
        totalPages() {
            return Math.ceil(this.rows.length / this.perPage);
        },
    },
    methods: {
        nextPage() {
            if (this.currentPage < this.totalPages) {
                this.currentPage++;
                this.animateButton();
            }
        },
        prevPage() {
            if (this.currentPage > 1) {
                this.currentPage--;
                this.animateButton();
            }
        },
        goToPage(page) {
            this.currentPage = page;
            this.animateButton();
        },
        animateButton() {
            const buttons = document.querySelectorAll('.page-number-button');
            buttons.forEach(button => {
                button.classList.add('animate');
                setTimeout(() => {
                    button.classList.remove('animate');
                }, 300);
            });
        },
        getColumnClass(index) {
            const columnCategories = [
                { color: 'accomplishments', range: [0, 1] },
                { color: 'billings', range: [2, 4] },
                { color: 'projects', range: [5, 6] },
                { color: 'status', range: [7, 9] },
                { color: 'project_contractor', range: [10, 15] },
                { color: 'projects_2', range: [16, 19] },
                { color: 'fund_sources', range: [20, 22] },
                { color: 'billings_2', range: [23, 24] },
                { color: 'change_orders', range: [25, 27] },
                { color: 'activities', range: [29, 36] },
                { color: 'recent_updates', range: [41, 43] },
            ];

            for (const category of columnCategories) {
                if (index >= category.range[0] && index <= category.range[1]) {
                    return category.color;
                }
            }
            return '';
        },
        sortData() {
            this.currentPage = 1;
        },

        resetFilters() {
        this.searchQuery = '';      
        this.selectedFilter = '';     
        this.dateSortOrder = '';      
        this.percentageSortOrder = ''; 
        this.currentPage = 1;         

        this.rows = this.initialJson; 
        },
    },
};
</script>
