const { createApp, defineComponent } = Vue;

// 1. Get the data from the HTML
const initialDataElement = document.getElementById('initial-data');
const usersJsonString = initialDataElement.getAttribute('data-users');
// Parse the JSON string into a JavaScript array/object
const usersArray = JSON.parse(usersJsonString);

// 2. Define the Vue Component for the Table Body
const UserList = defineComponent({
    data() {
        return {
            // Initialize the Vue data with the parsed users array
            users: usersArray 
        };
    },
    template: `
        <tr v-for="user in users" :key="user.id">
            <td>{{ user.id }}</td>
            <td>{{ user.email }}</td>
            <td>{{ user.full }}</td>
            <td>{{ user.address }}</td>
            <td>{{ user.phone }}</td>
            <td>
                <span :class="{'label label-danger': user.level === 1, 'label label-warning': user.level === 2}">
                    {{ user.level === 1 ? 'Manager' : 'Staff' }}
                </span>
            </td>
            <td>
                <a :href="'admin/user/edit/' + user.id" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                <a :href="'admin/user/delete/' + user.id" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')"><i class="fa fa-trash" aria-hidden="true"></i> Delete</a>
            </td>
        </tr>
    `,
});

// 3. Create and Mount the Vue Application
const app = createApp(UserList);
app.mount('#user-list-app');