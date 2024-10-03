<template>
    <div>
      <div class="mb-4 d-flex justify-content-between align-items-center">
        <input
          type="text"
          v-model="searchTerm"
          class="form-control custom-search-input"
          placeholder="Search by project title..."
        />
      </div>
  
      <div class="table-responsive table-container">
        <table class="table table-striped">
          <thead>
            <tr>
              <th scope="col">Project Title</th>
              <!-- Add other header columns as needed -->
            </tr>
          </thead>
          <tbody>
            <tr v-for="project in filteredProjects" :key="project.id">
              <td>{{ project.title }}</td>
              <!-- Add other project data as needed -->
            </tr>
            <tr v-if="filteredProjects.length === 0">
              <td colspan="1" class="text-center">No projects found</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        searchTerm: '',
        projects: [], // Assuming this will be populated with project data
      };
    },
    computed: {
      filteredProjects() {
        return this.projects.filter(project => 
          project.title.toLowerCase().includes(this.searchTerm.toLowerCase())
        );
      },
    },
    created() {
      this.fetchProjects(); // Fetch projects when the component is created
    },
    methods: {
      fetchProjects() {
        // Implement your API call to fetch projects
        // Example:
        // axios.get('/api/projects').then(response => {
        //   this.projects = response.data;
        // });
        // Replace with your actual API call to populate `projects`
        this.projects = [
          { id: 1, title: 'Project A' },
          { id: 2, title: 'Project B' },
          { id: 3, title: 'Project C' },
          // Add more sample projects for testing
        ];
      },
    },
  };
  </script>
  
  <style scoped>
  /* Add your styles here */
  .custom-search-input {
    width: 100%;
  }
  .table-container {
    margin-top: 20px;
  }
  </style>