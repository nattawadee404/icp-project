<template>
  <ul>
    <person-data
      v-for="item in myEmployees"
      :key="item.id"
      :id="item.id"
      :name="item.name"
      :study_faculty="item.study_faculty"
      :university="item.university"
      :disibility_type="item.disibility_type"
      :plan_career="item.plan_career"
      :salary="item.salary"
      :isVisible="item.isVisible"
      @showData="showData"
      @deleteData="deleteData"
    ></person-data>
  </ul>
</template>

<script>
 import PersonData from "./PersonData.vue";
export default {
  components: {
     PersonData,
  },
  data() {
    return {
      message: "List data component (แสดงข้อมูลทั้งหมด)",
      myEmployees: this.employees
    };
  },
  methods: {
    showData(id) {
      console.log("show child-id ", id);
      this.myEmployees = this.myEmployees.map((item) => {
        if (item.id === id) {
          return { ...item, isVisible: !item.isVisible };
        }
        return item;
      });
    },
    deleteData(id) {
      console.log("delete child-id ", id);
      this.myEmployees = this.myEmployees.filter((item) => {
        return item.id !== id;
      });
    },
  },
  props:["employees"]
  
};
</script>

<style scoped>
ีีีul {
  list-style: none;
  margin: 1rem 0;
  padding: 0;
}
</style>
