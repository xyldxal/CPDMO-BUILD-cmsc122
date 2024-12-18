<template>
  <div class="modal" @click.self="$emit('close')">
    <div class="modal-content">
      <div class="modal-header">
        <h2>Add New Entry</h2>
        <button @click="$emit('close')" class="close-btn">&times;</button>
      </div>

      <div class="modal-body">
        <!-- Tabs -->
        <div class="tabs">
          <button 
            v-for="tab in tabs" 
            :key="tab.id"
            :class="['tab-btn', { active: currentTab === tab.id }]"
            @click="currentTab = tab.id"
          >
            {{ tab.name }}
          </button>
        </div>

        <!-- Tab Content -->
        <div class="tab-content">
          <div v-for="tab in tabs" :key="tab.id" v-show="currentTab === tab.id" class="tab-pane">
            <div v-for="field in tab.fields" :key="field.name" class="form-group">
              <template v-if="field.type !== 'checkbox'">
                <label>{{ field.label }}:</label>
                <input 
                  v-if="['text', 'number', 'date'].includes(field.type)"
                  v-model="formData[field.name]"
                  :type="field.type"
                  class="form-input"
                >
                <textarea 
                  v-else-if="field.type === 'textarea'"
                  v-model="formData[field.name]"
                  class="form-input"
                ></textarea>
              </template>
              
              <!-- Checkbox -->
              <div v-else class="checkbox-group">
                <input 
                  :id="field.name"
                  type="checkbox"
                  v-model="formData[field.name]"
                >
                <label :for="field.name">{{ field.label }}</label>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-footer">
          <button @click="save" class="save-btn">Save</button>
          <button @click="$emit('close')" class="cancel-btn">Cancel</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'AddEntryForm',
  props: {
    tabs: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      currentTab: '',
      formData: {}
    }
  },
  created() {
    // Initialize currentTab with first tab's id
    if (this.tabs.length > 0) {
      this.currentTab = this.tabs[0].id;
    }
    // Initialize formData with empty values for all fields
    this.tabs.forEach(tab => {
      tab.fields.forEach(field => {
        this.formData[field.name] = field.type === 'checkbox' ? false :
                                   field.type === 'number' ? null : '';
      });
    });
  },
  methods: {
    save() {
      console.log('Form data to save:', this.formData);
      this.$emit('save', this.formData);
    }
  }
}
</script>

<style>
.modal {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 9999;
}

.modal-content {
  background: rgb(0, 80, 0);
  border-radius: 8px;
  width: 80%;
  max-width: 800px;
  max-height: 90vh;
  overflow-y: auto;
  position: relative;
  z-index: 10000;
}

.modal-header {
  padding: 1rem;
  background: #004d40;
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}

.modal-header h2 {
  margin: 0;
}

.close-btn {
  background: none;
  border: none;
  color: white;
  font-size: 1.5rem;
  cursor: pointer;
}

.modal-body {
  padding: 1rem;
}

.tabs {
  display: flex;
  border-bottom: none;
  margin-bottom: 1rem;
  background: #105700;
  gap: 2px;
}

.tab-btn {
  padding: 0.75rem 1.5rem;
  border: none;
  background: #004d25;
  color: white;
  font-weight: bold;
  transition: all 0.3s;
  border-radius: 0;
  opacity: 1;
  cursor: pointer;
}

.tab-btn:hover {
  background: #003d1e;
}

.tab-btn.active {
  background: #004d25;
  position: relative;
}

.form-group {
  margin-bottom: 1rem;
}

.form-group label {
  display: block;
  margin-bottom: 0.5rem;
  color: #333;
  font-weight: bold;
}

.checkbox-group {
  display: flex;
  align-items: center;
  gap: 0.5rem;
}

.checkbox-group label {
  margin-bottom: 0;
  cursor: pointer;
}

.form-input {
  width: 100%;
  padding: 0.5rem;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 1rem;
}

.form-input:focus {
  border-color: #004d40;
  outline: none;
}

textarea.form-input {
  min-height: 100px;
  resize: vertical;
}

.modal-footer {
  padding: 1rem;
  display: flex;
  justify-content: flex-end;
  gap: 1rem;
}

.save-btn, .cancel-btn {
  padding: 0.5rem 1.5rem;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  font-weight: bold;
}

.save-btn {
  background: #004d40;
  color: white;
}

.save-btn:hover {
  background: #00695c;
}

.cancel-btn {
  background: #f44336;
  color: white;
}

.cancel-btn:hover {
  background: #d32f2f;
}
</style>
