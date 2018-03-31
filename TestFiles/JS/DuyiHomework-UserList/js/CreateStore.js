function createStore(state){
    state=state||{};
    var list=[];
    function getState() {
        return state;
    }

    function getFunction(func) {
        list.push(func);
    }

    function setStateAndChange(obj) {
        for(var prop in obj){
            if(obj.hasOwnProperty(prop)){
                state[prop]=obj[prop];
            }
        }
        list.forEach(function (value) {
            value();
        });
    }
    return {
        getState:getState,
        getFunction:getFunction,
        setStateAndChange:setStateAndChange
    };
}