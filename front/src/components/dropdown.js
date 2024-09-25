import Dropdown from 'react-bootstrap/Dropdown';

function DropDown({ etages }) {
  return (
    <Dropdown>
      <Dropdown.Toggle variant="success" id="dropdown-basic">
        seléctionner l'étage
      </Dropdown.Toggle>

      <Dropdown.Menu>
        {etages.map((value) => (
          <Dropdown.Item>{value} </Dropdown.Item>
        ))}
      </Dropdown.Menu>
    </Dropdown>
  );
}

export default DropDown;