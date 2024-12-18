<template>
  <div class="projects-container">
    <div class="button-container">
      <button type="button" class="add-entry-btn" @click="openAddForm">Add Entry</button>
    </div>

    <div class="projects-table">
      <!-- Your existing table content -->
    </div>

    <teleport to="body">
      <add-entry-form 
        v-if="showAddForm"
        :tabs="tabs"
        @close="closeAddForm"
        @save="handleSave"
      />
    </teleport>
  </div>
</template>

<script>
import AddEntryForm from './AddEntryForm.vue'

export default {
  name: 'Projects',
  components: {
    AddEntryForm
  },
  data() {
    return {
      showAddForm: false,
      tabs: [
        { id: 'details', name: 'Project Details', fields: [
          { name: 'trackingNumber', label: 'Tracking Number', type: 'text' },
          { name: 'projectTitle', label: 'Project Title', type: 'text' },
          { name: 'description', label: 'Description', type: 'textarea' },
          { name: 'fundSource', label: 'Fund Source', type: 'text' },
          { name: 'endUser', label: 'End User', type: 'text' }
        ]},
        { id: 'budget', name: 'Budget Information', fields: [
          { name: 'budget', label: 'Total Budget', type: 'number' },
          { name: 'bidAmount', label: 'Bid Amount', type: 'number' },
          { name: 'contractor', label: 'Contractor', type: 'text' }
        ]},
        { id: 'timeline', name: 'Timeline', fields: [
          { name: 'startDate', label: 'Start Date', type: 'date' },
          { name: 'expectedCompletion', label: 'Expected Completion', type: 'date' },
          { name: 'status', label: 'Status', type: 'select', options: [
            { value: 'planning', label: 'Planning' },
            { value: 'ongoing', label: 'Ongoing' },
            { value: 'completed', label: 'Completed' },
            { value: 'delayed', label: 'Delayed' }
          ]}
        ]}
      ]
    }
  },
  mounted() {
    // Initialize any DataTables or other plugins here
    this.initializeDataTable();
  },
  methods: {
    initializeDataTable() {
      // Initialize DataTable functionality here if needed
    },
    openAddForm() {
      console.log('Opening add form');
      this.showAddForm = true;
    },
    closeAddForm() {
      console.log('Closing add form');
      this.showAddForm = false;
    },
    handleSave(formData) {
      console.log('Saving project:', formData);
      // Here you would send the data to your backend
      this.showAddForm = false;
    }
  }
}
</script>

<style scoped>
.projects-container {
  padding: 1rem;
  position: relative;
}

.button-container {
  margin-bottom: 1rem;
  display: flex;
  justify-content: flex-end;
}

.add-entry-btn {
  background: #00342b;
  color: white;
  padding: 0.75rem 2rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
  transition: background-color 0.3s;
}

.add-entry-btn:hover {
  background: #00695c;
}

/* Make sure modal is always on top */
.modal {
  z-index: 9999 !important;
}

.modal-content {
  z-index: 10000 !important;
}
</style>
