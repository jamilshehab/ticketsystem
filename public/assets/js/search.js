function agentFilter(agents) {
     return {
        agents,
        loading:false,
        selectedAgents: [],
        filteredAgents:[],  // filteredAgents are the agents that are not selected
        open: false, 
       
       filterAgents(e) {

        if (e.target.value === "") {
        return this.filteredAgents = this.agents;
       }
        return this.filteredAgents = this.agents.filter(agent => agent?.department?.department_name.toLowerCase().includes(e.target.value.toLowerCase()) || `${agent?.firstName?.toLowerCase()} ${agent?.lastName?.toLowerCase()}`.includes(e?.target?.value?.toLowerCase())); 
 
        },
         addSelectedAgents(id){
          const add_agents = this.filteredAgents.find((agent)=>agent.id === id);
          this.selectedAgents = [...this.selectedAgents,add_agents]; 
          this.filteredAgents = this.filteredAgents.filter(agent => 
          !this.selectedAgents.some(selected => selected.id === agent.id)
          );
         },  

        removeSelectedAgents(id){
        
        this.selectedAgents=this.selectedAgents.filter(agent => agent.id !== id); //so real time execution
        this.filteredAgents=this.selectedAgents.filter(agent => agent.id === id);
        //go to every list of agents the selected agents for example we needed to remove id 2 
        // Omar Itani Id : 1 1 is not equal to 2 so we keep it 
        // Mohammad Itani Id : 2 2 is equal to 2 so we remove it 
        },

         
        
       
    };
}
