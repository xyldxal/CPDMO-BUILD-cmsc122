<template>
    <div class="container">
      <div class="card-container">
        <h2 class="subtitle">Form Template</h2>
        <form @submit.prevent="submitForm">
          <div class="form-group">
            <input
              type="text"
              class="form-control input-field"
              v-model="form.name"
              placeholder="Username"
              required
            />
          </div>
  
          <div class="form-group">
            <input
              type="email"
              class="form-control input-field"
              v-model="form.email"
              placeholder="Email"
              required
            />
          </div>
  
          <div class="form-group">
            <input
              type="password"
              class="form-control input-field"
              v-model="form.password"
              placeholder="Password"
              required
              minlength="6"
            />
          </div>
  
          <div class="form-group">
            <input
              type="number"
              class="form-control input-field"
              v-model="form.age"
              placeholder="Age"
              required
              min="1"
              max="100"
            />
          </div>
  
          <div class="form-group">
            <input
              type="number"
              class="form-control input-field"
              v-model="form.amount"
              placeholder="Amount"
              step="0.01"
              required
            />
          </div>
  
          <div class="form-group">
            <select class="form-control input-field select-field" v-model="form.gender" required>
              <option value="" disabled selected>Gender</option>
              <option value="male">Male</option>
              <option value="female">Female</option>
              <option value="other">Other</option>
            </select>
          </div>
  
          <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">
              Submit
            </button>
          </div>
        </form>
      </div>
    </div>
  </template>
  
  <script>
  export default {
    data() {
      return {
        form: {
          name: '',
          email: '',
          password: '',
          age: null,
          amount: null,
          gender: '',
        },
      };
    },
    methods: {
      submitForm() {
        console.log(this.form);
        alert("Form submitted!");
      },
    },
  };
  </script>